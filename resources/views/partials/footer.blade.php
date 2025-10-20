@php
    $locale = session('locale', 'en');   // access sesh var named 'locale', 'en' is default fallback value

    $locales = [
        "en" => '🇬🇧 English',
        "es" => '🇪🇸 Spanish',
        "fr" => '🇫🇷 French',
        "de" => '🇩🇪 German',
        "ru" => '🇷🇺 Russian',
        "ar" => '🇸🇦 Arabic',
    ];
@endphp

<footer class="flex items-center justify-center gap-10 bg-[var(--bg)] border-t border-[var(--accent-2)] text-center text-[var(--accent)] text-sm py-4 font-mono tracking-widest">
  <p>{{__('ui.footer_text')}}</p>
  
  <select name="lang-select" class="bg-black cursor-pointer transition hover:opacity-60">
    <option disabled value="0">Language</option>
    @foreach ($locales as $k => $v)
        <option value="{{ $k }}" {{ $locale === $k ? 'selected' : '' }}>{{ $v }}</option>
    @endforeach
  </select>
</footer>


<script>
    // change UI language
    const selectEl = document.querySelector('select[name="lang-select"]');
    if (selectEl) {
        selectEl.addEventListener('change', function(e) {
            const langCodeChosen = e.target.value;
            location.href = `/lang/${langCodeChosen}`;
        })
    }
</script>