const fileNameDisplay = document.getElementById('fileNameDisplay');

function previewFile(item) {
    var fr = new FileReader();
    fr.onload = (function() {
        document.getElementById('preview').src = fr.result;
        document.getElementById('preview').style.display = 'block';
    });
    fr.readAsDataURL(item.files[0]);
    fileNameDisplay.textContent = item.files[0].name;
}
function submitForm(actionUrl, methodA) {
    document.getElementById('ProductForm').action = actionUrl;
    document.getElementById('ProductForm').method = methodA;
    document.getElementById('ProductForm').submit();
}
