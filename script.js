document.getElementById('healthForm').addEventListener('submit', function(e) {
    const heartbeat = document.getElementById('heartbeat').value;
    const sleep = document.getElementById('sleep').value;

    if (heartbeat < 30 || heartbeat > 200) {
        alert('Please enter a valid heartbeat between 30 and 200 BPM.');
        e.preventDefault();
    }

    if (sleep < 0 || sleep > 24) {
        alert('Sleep hours should be between 0 and 24.');
        e.preventDefault();
    }
});
