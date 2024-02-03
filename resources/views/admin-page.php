<?php
$create_bulk_codes_nonce = wp_create_nonce( 'create_bulk_codes_nonce' );
?>

<div>
    <h1>Create Bulk Codes</h1>

    <div id="cbc-success-message" class="notice notice-success" style="display: none;"></div>
    <div id="cbc-error-message" class="notice notice-error" style="display: none;"></div>

    <form id="generate-codes-form" class="w-50 mt-2">
        <div class="form-control">
            <label for="title">Title</label>
            <input type="text" name="title" id="title">
        </div>

        <div class="form-control">
            <label for="amount">Amount</label>
            <input type="number" name="amount" id="amount">
        </div>

        <div class="form-control">
            <label for="product_category">Product Kategorie (exkludieren)</label>
            <select name="product_category" id="product_category">
                <option value="">Select a category</option>
                <?php foreach ( get_terms( 'product_cat' ) as $term ) : ?>
                    <option value="<?php echo esc_attr( $term->term_id ); ?>">
                        <?php echo esc_html( $term->name ); ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="form-control">
            <label for="emails">Emails</label>
            <textarea name="emails" id="emails" cols="30" rows="10"></textarea>
        </div>

        <div class="form-control">
            <button id="generate-codes">Create Codes</button>
        </div>
    </form>

</div>
