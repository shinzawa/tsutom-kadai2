function previewFile(item) {
    var fr = new FileReader();
    fr.onload = (function() {
        document.getElementById('preview').src = fr.result;
    });
    fr.readAsDataURL(item.files[0]);
}
function submitForm(actionUrl, methodA) {
    document.getElementById('ProductForm').action = actionUrl;
    document.getElementById('ProductForm').method = methodA;
    document.getElementById('ProductForm').submit();
}
