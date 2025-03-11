        </div>
        <script src="https://cdn.ckeditor.com/ckeditor5/36.0.1/classic/ckeditor.js"></script>
        <script>
            ClassicEditor
                .create(document.querySelector('#editor1'))
                .catch(error => {
                    console.error('CKEditor error:', error);
            });
        </script>
    </body>
</html>