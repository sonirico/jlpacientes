<?php $referrer = $this->agent->is_referral() ? $this->agent->referrer() : base_url($back_uri); ?>
<a href="<?php echo $referrer; ?>" role="button" class="btn btn-warning back"  >
    Volver
</a>