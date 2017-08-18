<?php if ($this->session->status): ?>
    <?php if ('success' === $this->session->status): ?>
        <div class="alert alert-success alert-dismissible show" role="alert" >
    <?php elseif ('error' === $this->session->status): ?>
        <div class="alert alert-danger alert-dismissible show" role="alert" >
    <?php endif; ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <strong><?php echo $this->session->message; ?></strong>
        </div>
<?php endif; ?>