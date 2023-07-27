
console.log('ready');

$data = fetch('http://localhost:8000/api/projects/').then(response => response.json());
console.log($data);