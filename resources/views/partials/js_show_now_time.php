<script>
    function showTime () {
        if (document.querySelector('.time')) document.querySelector('.time').remove();

        const now = new Date();
        
        const formatted = new Intl.DateTimeFormat(undefined,{weekday:'short',month:'short',day:'numeric',year:'numeric',hour:'numeric',minute:'numeric'}).format(now);

        const date = formatted.split(' ').slice(0,-2).join(' ').slice(0,-1);
        const time = formatted.split(' ').slice(-2).join(' ').toLowerCase()
        const timeEl = time.split(':').join(`<span style="animation:blink 2s infinite">:</span>`);

        const title = `${now.getFullYear()}-${(now.getMonth()+1).toString().padStart(2, '0')}-${now.getDate().toString().padStart(2, '0')} — ${now.getHours()}:${now.getMinutes().toString().padStart(2, '0')}`;

        document.body.insertAdjacentHTML('beforeend', `<div title="${title}" class="time font-mono text-[12px] text-[#333] hover:text-[#eee] bg-black transition hover:scale-125 fixed bottom-[10px] left-[10px] hover:translate-x-4">
            <div>${date}</div>
            <div>${timeEl}</div>
        </div>`)
    }

    showTime();
    setInterval(() => { showTime() }, 1000*60);
</script>