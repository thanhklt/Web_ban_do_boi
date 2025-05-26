// popup.js
document.addEventListener('DOMContentLoaded', () => {
  const overlay   = document.getElementById('orderDetailsPopup');
  const closeBtn  = overlay.querySelector('.close-popup');
  const container = document.getElementById('ordersContainer');

  // Đóng popup
  closeBtn.addEventListener('click', () => overlay.style.display = 'none');
  overlay.addEventListener('click', e => {
    if (e.target === overlay) overlay.style.display = 'none';
  });

  // Bắt click trên nút Chi tiết
  document.body.addEventListener('click', e => {
    const btn = e.target.closest('.bth-detail');
    if (!btn) return;

    const userId = btn.dataset.userId;
    if (!userId) return;

    // Lấy ngày từ form lọc trên trang
    const df = document.querySelector('input[name="date_from"]').value;
    const dt = document.querySelector('input[name="date_to"]').value;

    // Hiển thị popup & loading
    overlay.style.display = 'flex';
    container.innerHTML = '<p>Đang tải…</p>';

    // Gọi endpoint với params
    const params = new URLSearchParams({ user_id: userId, date_from: df, date_to: dt });
    fetch(`customer_order_detail.php?${params}`)
      .then(r => {
        if (!r.ok) throw new Error(`HTTP ${r.status}`);
        return r.json();
      })
      .then(data => {
        if (!data.orders || !data.orders.length) {
          container.innerHTML = '<p>Không có đơn trong khoảng này.</p>';
          return;
        }
        // Render từng đơn
        container.innerHTML = data.orders.map(o => {
          const rows = o.items.map(i => `
            <tr>
              <td><p style="text-align:center">${i.product_id}</p></td>
              <td><p style="text-align:center">${i.product_name}</p></td>
              <td><p style="text-align:center">${i.num}</p></td>
            </tr>
          `).join('');
          return `
            <div class="order-detail">
              <div class="order-header">
                <h2 class="primary">Mã đơn #${o.order_id}</h2>
                <p>Ngày đặt: ${new Date(o.order_date).toLocaleString('vi-VN')}</p>
                <p>Tổng: ${Number(o.total_amount).toLocaleString('vi-VN')}₫</p>
              </div>
              <br>
              <table class="order-items-table">
                <thead>
                  <tr><th>Mã SP</th><th>Tên SP</th><th>Số lượng</th></tr>
                </thead>
                <tbody>${rows}</tbody>
                <hr style="border-bottom: 2px solid">
              </table>
              <br>
            </div>
          `;
        }).join('');
      })
      .catch(err => {
        console.error('Fetch error:', err);
        container.innerHTML = '<p class="error">Lỗi tải dữ liệu.</p>';
      });
  });
});
