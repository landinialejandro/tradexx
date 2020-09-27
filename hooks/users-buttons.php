<li class="nav-item">
    <a href="#" class="nav-link" id="start-work">
        <i class="nav-icon fas fa-play text-success"></i>
        <p>Start Working</p>
    </a>
</li>

<script>
    $j('#start-work').on('click', function() {
        $this = $j(this);
        $this.toggleClass("stopw");
        $this.children('i').toggleClass('fa-play fa-stop text-danger text-success');
        if ($this.hasClass('stopw')) {
            $this.children('p').text('Stop Working');
            //inicia el trabajo, agregar un registro en payroll
            payroll('startw');
        } else {
            $this.children('p').text('Start Working');
            //finaliza el trabajo cierra registro en pyroll
            payroll('stopw');
        }
    })
    setTimeout(() => {
        //controlar si ya tiene un trabajo iniciado.
        $j.get('hooks/Payroll-ajax.php', {
                id: "status",
                cmd: "get-status"
            })
            .done(function(res) {
                if (res.custom_msg) {
                    show_notification(res.custom_msg);
                }
                $option = $j('#start-work');
                if ($option.hasClass('stopw')) {
                    if (!res.status) {
                        // cambiar la clase a starw
                        $option.toggleClass('stopw')
                    }
                } else {
                    if (res.status) {
                        // cambiar la clase a stopw
                        $option.toggleClass("stopw");
                        $option.children('i').toggleClass('fa-play fa-stop text-danger text-success');
                        $option.children('p').text('Stop Working');
                    } else {
                        // cambiar la clase a startw
                        //$option.removeClass('stopw')
                        //$option.children('p').text('Start Working');
                    }
                }
            });
    }, 50);

    function payroll(cmd = false) {
        if (cmd) {
            $j.ajax({
                type: "POST",
                url: "hooks/Payroll-ajax.php",
                data: {
                    cmd: cmd
                },
                dataType: "json",
                success: function(res) {
                    if (res.custom_msg) {
                        show_notification(res.custom_msg);
                    }
                }
            });
        }
    }
</script>