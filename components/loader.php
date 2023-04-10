<link rel="stylesheet" href="css/loader.css">

<div id="loader-wrapper">
    <div class="cube">
        <div></div>
        <div></div>
        <div></div>
        <div></div>
        <div></div>
        <div></div>
    </div>
</div>

<script>
    window.addEventListener('load', (event) => {
        var fadeTarget = document.getElementById("loader-wrapper");
        var fadeEffect = setInterval(function () {
            if (!fadeTarget.style.opacity) {
                fadeTarget.style.opacity = 1;
            }
            if (fadeTarget.style.opacity > 0) {
                fadeTarget.style.opacity -= 0.1;
            } else {
                fadeTarget.style.zIndex = -1;
                clearInterval(fadeEffect);
            }
        }, 50);
    });
</script>