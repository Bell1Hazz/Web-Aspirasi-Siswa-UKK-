@if(session('success'))
    <div id="flash-message" 
         style="
            position: fixed;
            top: 20px;
            right: 20px;
            background: #198754;
            color: white;
            padding: 12px 20px;
            border-radius: 8px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.2);
            z-index: 9999;
         ">
        {{ session('success') }}
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            let flash = document.getElementById('flash-message');

            if (flash) {
                setTimeout(() => {
                    flash.style.transition = "opacity 0.5s ease";
                    flash.style.opacity = "0";

                    setTimeout(() => {
                        flash.remove();
                    }, 500);
                }, 3000); // tampil 3 detik
            }
        });
    </script>
@endif