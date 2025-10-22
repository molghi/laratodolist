<style>
    /* accent colors */
    :root {
        --bg: #000;
        --accent: #7dd3fc; /* Tailwind’s text-sky-300 */
        --accent-2: #0ea5e9; /* text-sky-500 */
        --accent-3: #38bdf8; /* text-sky-400 */
        --accent-4: #0284c7; /* text-sky-600 */
    }

    /* to shut up red non-https warning */
    body > div[style] {
        display: none !important;
    }

    /* thin dark scrollbar */
    /* Chrome, Edge, Safari */
    ::-webkit-scrollbar{width:8px;height:8px}
    ::-webkit-scrollbar-track{background:transparent}
    ::-webkit-scrollbar-thumb{background:rgba(100,100,100,0.6);border-radius:999px;border:2px solid transparent;background-clip:padding-box}
    ::-webkit-scrollbar-thumb:hover{background:rgba(100,100,100,0.8)}
    /* Firefox */
    *{scrollbar-width:thin;scrollbar-color:rgba(100,100,100,0.6) transparent}

    /* date input picker element */
    input[type="date"] {
        color-scheme: dark; /* Helps default icon render visible on dark bg */
    }

    /* input[type="date"]::-webkit-calendar-picker-indicator {
        filter: invert(1) !important;  Inverts color to make it visible on dark background 
        border: 2px red solid;
        cursor: pointer;
    } */

    input[type="datetime-local"] {
        position: relative;
        background-color: #000; /* your bg */
        color: #e5e7eb; /* light gray text */
    }

    input[type="datetime-local"]::-webkit-calendar-picker-indicator {
        opacity: 0; /* hide native icon */
        position: absolute;
        right: 10px;
        z-index: 2;
        cursor: pointer;
    }

    input[type="datetime-local"]::after {
        content: "🗓";
        position: absolute;
        right: 12px;
        top: 50%;
        transform: translateY(-50%);
        pointer-events: none;
        color: #93c5fd; /* light blue accent */
    }


    @keyframes blink{0%,49%{opacity:0}50%,100%{opacity:1}}

    .my-pagination a, .my-pagination span {
        background-color: #000;
        color: var(--accent);
        border-color: var(--accent);
    }

    .my-pagination a:hover {
        color: var(--accent);
        background-color: #222;
    }

    .ck, .description {
        font-family: Menlo, Consolas, 'Courier New', Courier, monospace !important;
    }

    .description h1 { font-size: 2em; font-weight: bold; }
    .description h2 { font-size: 1.75em; font-weight: bold; }
    .description ul {
        list-style-type: disc;
        padding-left: 3em;
    }
    .description ol {
        list-style-type: decimal;
        padding-left: 3em;
    }
    .description li {
        margin-bottom: 0.25em;
        color: #eee; /* ensure visible on dark background */
    }

    .ck.ck-editor__main > .ck-editor__editable {
    background-color: #111 !important;
    color: #eee !important;
    }
    .ck.ck-toolbar {
    background-color: #222 !important;
    border-color: #333 !important;
    }
    .ck.ck-button,
    .ck.ck-dropdown__button {
    color: #ccc !important;
    }

    .ck-editor__editable h1 {
        font-size: 36px !important;
    }
    .ck-editor__editable h2 {
        font-size: 28px !important;
    }
    .ck-editor__editable h3 {
        font-size: 22px !important;
    }
    .ck-editor__editable h1,
    .ck-editor__editable h2,
    .ck-editor__editable h3,
    .ck-editor__editable h4,
    .ck-editor__editable h5,
    .ck-editor__editable h6 {
        color: #eee !important; /* make headings visible */
    }

    .ck-editor__editable span {
        display: inline-block !important;
    }

    .ck-editor__editable ul,
    .ck-editor__editable ol {
        color: #eee !important; /* text color for list items */
        list-style-position: inside; /* ensure bullets/numbers appear */
        margin-left: 1.2em;
        padding-left: 0; /* reset padding */
    }

    .ck-editor__editable li {
        display: list-item;  /* must be list-item */
        white-space: normal; /* ensure inline numbering */
        color: #eee;
    }

</style>

