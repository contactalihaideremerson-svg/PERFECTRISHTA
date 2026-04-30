<!-- Google Translate & Urdu Support Setup -->
<link href="https://fonts.googleapis.com/css2?family=Noto+Nastaliq+Urdu:wght@400;700&display=swap" rel="stylesheet">
<style>
    /* Urdu Font & RTL Support */
    [lang="ur"] body,
    [lang="ur"] .font-sans,
    [lang="ur"] aside,
    [lang="ur"] main {
        font-family: 'Noto Nastaliq Urdu', serif !important;
        direction: rtl;
        text-align: right;
    }

    /* Hide Google Translate Bar */
    .goog-te-banner-frame.skiptranslate,
    .goog-te-gadget-icon {
        display: none !important;
    }

    body {
        top: 0px !important;
    }

    /* Fix for layout switches */
    [lang="ur"] .flex-row-reverse-rtl {
        flex-direction: row-reverse;
    }
</style>

<!-- Google Translate Hidden Widget -->
<div id="google_translate_element" style="display:none !important"></div>

<script type="text/javascript">
    function googleTranslateElementInit() {
        new google.translate.TranslateElement({
            pageLanguage: 'en',
            includedLanguages: 'en,ur',
            layout: google.translate.TranslateElement.InlineLayout.SIMPLE,
            autoDisplay: false
        }, 'google_translate_element');
    }

    function changeLanguage(lang) {
        var selectField = document.querySelector(".goog-te-combo");
        if (selectField) {
            selectField.value = lang;
            selectField.dispatchEvent(new Event('change'));
        }

        // Update UI states
        document.querySelectorAll('.lang-btn-en').forEach(btn => lang === 'en' ? btn.classList.add('active') : btn.classList.remove('active'));
        document.querySelectorAll('.lang-btn-ur').forEach(btn => lang === 'ur' ? btn.classList.add('active') : btn.classList.remove('active'));

        if (lang === 'ur') {
            document.documentElement.setAttribute('lang', 'ur');
            localStorage.setItem('preferred_lang', 'ur');
        } else {
            document.documentElement.setAttribute('lang', 'en');
            localStorage.setItem('preferred_lang', 'en');
        }
    }

    // Persistence on load
    window.addEventListener('load', function () {
        var savedLang = localStorage.getItem('preferred_lang');
        if (savedLang === 'ur') {
            var checkInterval = setInterval(function () {
                var selectField = document.querySelector(".goog-te-combo");
                if (selectField) {
                    changeLanguage('ur');
                    clearInterval(checkInterval);
                }
            }, 100);

            // Safety timeout
            setTimeout(function () { clearInterval(checkInterval); }, 5000);
        }
    });
</script>
<script type="text/javascript"
    src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>