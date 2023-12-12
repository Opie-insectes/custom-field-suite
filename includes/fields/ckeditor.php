<?php

class cfs_ckeditor extends cfs_field
{
    public function __construct()
    {
        $this->name = 'ckeditor';
        $this->label = __('Wysiwyg Editor (CKEditor)', 'cfs');
    }

    public function html($field)
    {
        ?>
        <textarea
            name="<?php echo $field->input_name; ?>"
            class="wp-editor-area <?php echo $field->input_class; ?>"
            style="height:300px"><?php echo $field->value; ?></textarea>
        <?php
    }

    public function input_head($field = null)
    {
        ?>
        <script src="https://cdn.ckeditor.com/ckeditor5/40.2.0/classic/ckeditor.js"></script>
        <script>
        document.addEventListener('DOMContentLoaded', () => {
            // Setup CKEditor with all the textareas with the ckeditor class.
            const textareas = document.querySelectorAll("textarea.ckeditor");
            Array.from(textareas).forEach((textarea) => {
                ClassicEditor
                    .create(textarea)
                    .then((editor) => {
                        // Keep the textarea in sync with the editor data.
                        editor.model.document.on('change:data', () => {
                            textarea.innerText = editor.getData();
                        });
                    })
                    .catch((error) => { console.error(error); });
            });
        });
        </script>
        <?php
    }
}