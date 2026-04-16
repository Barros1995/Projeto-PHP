    </div>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            var confirmElements = document.querySelectorAll("[data-confirm]");
            confirmElements.forEach(function (element) {
                var message = element.getAttribute("data-confirm");
                if (!message) {
                    return;
                }

                var tag = element.tagName.toLowerCase();
                if (tag === "form") {
                    element.addEventListener("submit", function (event) {
                        if (!confirm(message)) {
                            event.preventDefault();
                        }
                    });
                } else if (tag === "a") {
                    element.addEventListener("click", function (event) {
                        if (!confirm(message)) {
                            event.preventDefault();
                        }
                    });
                }
            });
        });
    </script>
</body>
</html>
