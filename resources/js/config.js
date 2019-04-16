export const topProgressBar = {
    color: '#08ddc1',
    failedColor: '#ff5e3a',
    thickness: '4px',
    transition: {
        speed: '0.2s',
        opacity: '0.6s',
        termination: 300
    }
}


// Config Editor Quill
export const editorOption = {
    modules: {
        history: {
          delay: 1000,
          maxStack: 50,
          userOnly: false
        },
        toolbar: [
            ['bold', 'italic', 'underline', 'strike', { 'header': 1 }, { 'header': 2 }],
            [{ 'header': [1, 2, 3, 4, 5, 6, false] }],
            ['blockquote', 'code-block'],
            ['link', 'image'],
            [{ 'list': 'ordered'}, { 'list': 'bullet' }],
            [{ 'color': [] }, { 'background': [] }],
            [{ 'align': [] }],
            ['fullscreen']
        ],
        imageImport: true,
        imageResize: {
          displaySize: true
        }
    }
}