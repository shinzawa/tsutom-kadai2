function handleSelectChange(selected) {
    let selectedValue; // 選択値を保持する変数
    const divElementDesc = document.getElementById('sort-order-tag-desc');
    const divElementAsc = document.getElementById('sort-order-tag-asc');
    selectedValue = selected.value;
    if (selected.value == 'desc') {
        divElementDesc.style.display = 'block';
        divElementAsc.style.display = 'none';
    } else if (selected.value == 'asc') {
        divElementAsc.style.display = 'block';
        divElementDesc.style.display = 'none';
    } else {
        divElementDesc.style.display = 'none';
        divElementAsc.style.display = 'none';
    }

    selected.form.submit();

    if (selectedValue == 'desc') {
        divElementDesc.style.display = 'block';
        divElementAsc.style.display = 'none';
    } else if (selectedValue == 'asc') {
        divElementAsc.style.display = 'block';
        divElementDesc.style.display = 'none';
    } else {
        divElementDesc.style.display = 'none';
        divElementAsc.style.display = 'none';
    }
}

// ページ読み込み時に選択値を再設定する処理
window.onload = function () {
    if (selectedValue) { // 値が保持されている場合
        document.getElementById('sortSelected').value = selectedValue;
    }
    const divElementDesc = document.getElementById('sort-order-tag-desc');
    const divElementAsc = document.getElementById('sort-order-tag-asc');

    alert(selectedValue);
    if (selectedValue == 'desc') {
        divElementDesc.style.display = 'block';
        divElementAsc.style.display = 'none';
    } else if (selectedValue == 'asc') {
        divElementAsc.style.display = 'block';
        divElementDesc.style.display = 'none';
    } else {
        divElementDesc.style.display = 'none';
        divElementAsc.style.display = 'none';
    }
}