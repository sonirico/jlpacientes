<html>
<head>
    <style>
        @page { margin: 100px 25px;}
        header { position: fixed; top: -60px; left: 0px; right: 0px; background-color: lightblue; height: 50px; }
        footer { position: fixed; bottom: -60px; left: 0px; right: 0px; background-color: lightblue; height: 50px; }
            /*p { page-break-after: always; }*/
            /*p:last-child { page-break-after: never; }*/

        .container {
            background-color:red;

        }

        .injury {
            outline: orange solid 2px;
        }
    </style>
</head>
    <body>
        <header>header on each page</header>
        <footer>
            footer on each page
                <script type="text/php">
                echo $PAGE_NUM;
                    if (isset($pdf))
            {
            echo $PAGE_NUM;
            $font = $fontMetrics->getFont("Arial", "bold");
            $pdf->page_text(170, 580, $PAGE_NUM, $font, 10, array(0, 0, 0));
            $pdf->line(10, 575, 830, 575, array(0,0,0), 1);
            }
                </script>
        </footer>

        <?php

            $inj_cat = $this->config->item('injuries');

        ?>

        <div class="container" >

            <?php foreach ($injuries as $i): ?>

                <div class="injury" >
                    <div class="row" >
                        <div class="col-md-4 injury-type" >
                            <p><?php echo $inj_cat[$i['type']]; ?></p>
                        </div>

                        <div class="col-md-4 injury-time" >
                            <time><?php echo $i['happened_at']; ?></time>
                        </div>

                        <div class="col-md-4 injury-days" >
                            <p><?php echo $i['days_off']; ?></p>
                        </div>
                    </div>
                    <div class="row" >
                        <div class="col-md-12 injury-description" >
                            <p><?php echo $i['description']; ?></p>
                        </div>
                    </div>
                </div>

            <?php endforeach; ?>

        </div>

        <?php //$this->load->view('partials/footer'); ?>

    </body>
</html>