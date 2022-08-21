<?php
$this->db->from('bf_support_faq');
$this->db->where('active', 'yes');
$getFAQs = $this->db->get();
?>
<section class="content04 cid-s0IVv1oGAS" id="content04-8">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12 col-lg-12">
                <h2 class="mbr-section-title pb-3 mbr-bold pb-3 mbr-fonts-style display-5">Frequently asked questions</h2>
            </div>
            <div class="mbr-black col-md-12 col-lg-6">
                <ul>
                    <?php
                    foreach ($getFAQs->result_array() as $faq) {
                        if ($faq['position'] === 'Left') {
                            echo '
                            <li class="item-title mbr-bold mbr-fonts-style display-4">' . $faq['topic'] . '<br>
                                <p class="mbr-text mbr-regular mbr-fonts-style">' . $faq['description'] . '</p>
                            </li>
                            ';
                        }
                    }
                    ?>
                </ul>
            </div>
            <div class="mbr-black col-md-12 col-lg-6">
                <ul>
                    <?php
                    foreach ($getFAQs->result_array() as $faq) {
                        if ($faq['position'] === 'Right') {
                            echo '
                            <li class="item-title mbr-bold mbr-fonts-style display-4">' . $faq['topic'] . '<br>
                                <p class="mbr-text mbr-regular mbr-fonts-style">' . $faq['description'] . '</p>
                            </li>
                            ';
                        }
                    }
                    ?>
                </ul>
            </div>
        </div>
    </div>
</section>
