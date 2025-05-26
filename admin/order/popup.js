// popup.js
console.log('✅ popup.js đã được tải');

(function(){
  console.log('📦 popup.js chạy ngay lập tức');

  // Dùng event delegation (bắt cả những nút mới render lại)
  document.addEventListener('click', e => {
    const btn = e.target.closest('.bth-detail');
    if (!btn) return;

    const orderId = btn.dataset.orderId;
    console.log(`» Delegated click order #${orderId}`);

    // Các element trong popup
    const popup    = document.getElementById('orderDetailsPopup');
    const closeBtn = popup.querySelector('.close-popup');
    const elOrderId   = document.getElementById('popupOrderId');
    const elFullname  = document.getElementById('popupFullname');
    const elOrderDate = document.getElementById('popupOrderDate');
    const elTotal     = document.getElementById('popupTotal');
    const tbody       = document.querySelector('#orderDetailsTable tbody');

    if (!popup || !closeBtn || !elOrderId) {
      return console.error('🚨 Thiếu element trong popup');
    }

    // Hiện trạng thái loading
    elOrderId.textContent   = orderId;
    elFullname.textContent  = 'Đang tải…';
    elOrderDate.textContent = 'Đang tải…';
    elTotal.textContent     = 'Đang tải…';
    tbody.innerHTML         = '<tr><td colspan="3">Đang tải…</td></tr>';

    // Fetch dữ liệu
    const url = `./order_detail.php?order_id=${orderId}`;
    console.log('» Fetching URL:', url);
    fetch(url)
      .then(res => {
        console.log('» HTTP status:', res.status);
        if (!res.ok) throw new Error(`HTTP ${res.status}`);
        return res.json();
      })
      .then(data => {
        console.log('» JSON received:', data);
        if (!data.order || !Array.isArray(data.items)) {
          throw new Error('JSON không đúng định dạng');
        }
        const o = data.order;
        elFullname.textContent  = o.fullname;
        elOrderDate.textContent = new Date(o.order_date).toLocaleString('vi-VN');
        elTotal.textContent     = Number(o.total_amount).toLocaleString('vi-VN') + '₫';

        tbody.innerHTML = '';
        data.items.forEach(item => {
          const tr = document.createElement('tr');
          tr.innerHTML = `
            <td>${item.product_id}</td>
            <td>${item.product_name}</td>
            <td>${item.quantity}</td>
          `;
          tbody.appendChild(tr);
        });
      })
      .catch(err => {
        console.error('» Fetch error:', err);
        tbody.innerHTML = '<tr><td colspan="3">Lỗi tải dữ liệu</td></tr>';
      });

    // Mở popup
    popup.style.display = 'flex';

    // Gắn sự kiện đóng
    closeBtn.onclick = () => popup.style.display = 'none';
  });
})();
