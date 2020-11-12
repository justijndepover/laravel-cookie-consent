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
                    const regex = /<script[\s\S]*?>([\s\S]*?)<\/script>/gi;
                    var scripts = htmlToElements(response);

                    scripts.forEach((script, i) => {
                        if (script.outerHTML == undefined) {
                            return;
                        }

                        if (script.outerHTML.match(regex)) {
                            var element = document.createElement("script");
                            var node = document.createTextNode(script.innerHTML);
                            element.appendChild(node);
                        } else {
                            var element = script;
                        }

                        document.getElementsByTagName('body')[0].appendChild(element);
                    });
                });
            }

            function refuseCookies() {
                hideDialog();
                setCookie(0, (response) => {
                    //
                });
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

            function htmlToElements(html) {
                var template = document.createElement('template');
                template.innerHTML = html;
                return template.content.childNodes;
            }
        })();
    </script>
@elseif (request()->cookie(config('cookie-consent.cookie_name')) != false)
    {!! $cookies !!}
@endif
