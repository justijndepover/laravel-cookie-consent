@if (request()->hasCookie(config('cookie-consent.cookie_name')) != true)
    @include('cookie-consent::cookiebar')

    <script>
        window.laravelCookieConsent = (function () {
            const acceptButton = document.querySelectorAll('[data-accept-cookies')[0];
            const refuseButton = document.querySelectorAll('[data-refuse-cookies')[0];

            acceptButton.addEventListener('click', acceptCookies);
            refuseButton.addEventListener('click', refuseCookies);

            function hideDialog() {
                const dialog = document.querySelectorAll('[data-cookie-consent-dialog')[0];
                dialog.style.display = 'none';
            }

            function acceptCookies() {
                hideDialog();
                setCookie(1, (response) => {
                    console.log(response);
                })
            }

            function refuseCookies() {
                hideDialog();
                setCookie(0, (response) => {
                    console.log(response);
                })
            }

            function setCookie(state, callback) {
                var xmlHttp = new XMLHttpRequest();
                xmlHttp.onreadystatechange = function () {
                    if (xmlHttp.readyState == 4 && xmlHttp.status == 200) {
                        callback(xmlHttp.responseText);
                    }
                }
                xmlHttp.open("POST", '/cookie-consent', true);
                xmlHttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                xmlHttp.send(`state=${state}&_token={{ csrf_token() }}`);
            }
        })();
    </script>
@endif
