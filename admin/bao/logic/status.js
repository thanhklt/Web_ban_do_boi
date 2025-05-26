document.querySelectorAll('.lock-btn').forEach(btn=>{
  btn.addEventListener('click', ()=>{
    const userId = btn.dataset.id;
    const wasLocked = btn.dataset.locked === '1';
    const newLock   = wasLocked ? 0 : 1;

    fetch('../bao/database/toggle_lock_user.php', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json;charset=utf-8'
      },
      body: JSON.stringify({
        id:   userId,
        lock: newLock
      })
    })
    .then(res => {
      if (!res.ok) throw new Error(`HTTP ${res.status}`);
      return res.json();
    })
    .then(data => {
      console.log('Response:', data);
      if (!data.success) return alert('Lỗi server: ' + data.message);

      // Cập nhật nút
      btn.dataset.locked = newLock;
      if (newLock) {
        btn.classList.replace('btn-green','btn-red');
        btn.textContent = 'Đã khóa';
      } else {
        btn.classList.replace('btn-red','btn-green');
        btn.textContent = 'Hoạt động';
      }
    })
    .catch(err => {
      console.error(err);
      alert('Không thể cập nhật trạng thái:\n' + err.message);
    });
  });
});
