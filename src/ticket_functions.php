<?php
function tickets_file_path() {
  return __DIR__ . '/../tickets.json';
}

function read_tickets() {
  $file = tickets_file_path();
  if (!file_exists($file)) return [];
  $json = file_get_contents($file);
  $arr = json_decode($json, true);
  return is_array($arr) ? $arr : [];
}

function write_tickets($tickets) {
  file_put_contents(tickets_file_path(), json_encode($tickets, JSON_PRETTY_PRINT));
}

function normalize_status($status) {
  if (!$status) return 'open';
  $s = strtolower(trim($status));
  $s = str_replace(' ', '_', $s);
  if (in_array($s, ['open','in_progress','inprogress','progress'])) return $s === 'inprogress' ? 'in_progress' : ($s === 'progress' ? 'in_progress' : $s);
  if ($s === 'closed' || $s === 'close') return 'closed';
  return 'open';
}

function get_tickets() {
  $tickets = read_tickets();
  return array_map(function($t){
    if (isset($t['status'])) $t['status'] = normalize_status($t['status']);
    else $t['status'] = 'open';
    return $t;
  }, $tickets);
}

function add_ticket($data) {
  $tickets = read_tickets();
  $id = time() . rand(100,999);
  $ticket = [
    'id' => $id,
    'title' => trim($data['title'] ?? ''),
    'description' => trim($data['description'] ?? ''),
    'status' => normalize_status($data['status'] ?? 'open'),
    'priority' => strtolower(trim($data['priority'] ?? 'medium')),
    'createdAt' => time(),
    'updatedAt' => time(),
  ];
  $tickets[] = $ticket;
  write_tickets($tickets);
  return $ticket;
}

function update_ticket($id, $data) {
  $tickets = read_tickets();
  $updated = false;
  $tickets = array_map(function($t) use ($id, $data, &$updated){
    if ($t['id'] == $id) {
      $t['title'] = isset($data['title']) ? trim($data['title']) : $t['title'];
      $t['description'] = isset($data['description']) ? trim($data['description']) : $t['description'];
      $t['status'] = isset($data['status']) ? normalize_status($data['status']) : $t['status'];
      $t['priority'] = isset($data['priority']) ? strtolower(trim($data['priority'])) : $t['priority'];
      $t['updatedAt'] = time();
      $updated = true;
    }
    return $t;
  }, $tickets);
  write_tickets($tickets);
  return $updated;
}

function delete_ticket($id) {
  $tickets = read_tickets();
  $filtered = array_values(array_filter($tickets, function($t) use ($id){
    return $t['id'] != $id;
  }));
  write_tickets($filtered);
  return true;
}

function get_ticket_by_id($id) {
  $tickets = get_tickets();
  foreach ($tickets as $t) if ($t['id'] == $id) return $t;
  return null;
}

function get_ticket_stats() {
  $tickets = get_tickets();
  $total = count($tickets);
  $open = count(array_filter($tickets, function($t){ return $t['status'] === 'open'; }));
  $inProgress = count(array_filter($tickets, function($t){ return $t['status'] === 'in_progress'; }));
  $closed = count(array_filter($tickets, function($t){ return $t['status'] === 'closed'; }));
  return ['total' => $total, 'open' => $open, 'inProgress' => $inProgress, 'closed' => $closed];
}
