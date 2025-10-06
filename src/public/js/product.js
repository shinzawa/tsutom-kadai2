function handleSelectChange(selected) {
    let selectedValue; // 選択値を保持する変数
    const divElementDesc = document.getElementById('sort-order-tag-desc');
    const divElementAsc = document.getElementById('sort-order-tag-asc');
    selectedValue = selected.value;
    selected.style.color = '#4B4B4B'
    if (selected.value == 'desc') {
        divElementDesc.style.display = 'block';
        divElementAsc.style.display = 'none';
    } else if (selected.value == 'asc') {
        divElementAsc.style.display = 'block';
        divElementDesc.style.display = 'none';
    } else {
        divElementDesc.style.display = 'none';
        divElementAsc.style.display = 'none';
        selected.style.color = '#E0DFDE' 
    }

    selected.form.submit();
}
