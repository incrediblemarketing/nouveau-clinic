<?php $business_location = get_field('business_locations', 'options')[0]; ?>

<?php if ($business_location['business_phone_display'] && $business_location['business_phone_url']) : ?>
    <a class="call btn btn-primary" href="tel:<?php echo $business_location['business_phone_url']; ?>">
        <i class="fa fa-phone"></i> <span><?php echo $business_location['business_phone_display']; ?></span>
    </a>
<?php endif; ?>