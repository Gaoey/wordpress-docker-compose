<table class="form-table catmandu-page-settings-box" role="presentation">
	<tbody>
		<tr>
			<th scope="row"><label for="header_top"><?php _e( 'Enable Top Header ?', 'catmandu' ); ?></label></th>
			<td>
				<select name="enable_top_header" class="enable-top-header">
					<option value="global" <?php !empty( $value['top-header-layout'] ) ? selected( $value['top-header-layout'], 'global' ) : false; ?>><?php esc_html_e('Set to Global', 'catmandu'); ?></option>
					<option value="enable" <?php !empty( $value['top-header-layout'] ) ? selected( $value['top-header-layout'], 'enable' ) : false; ?>><?php esc_html_e('Enable Top Header', 'catmandu'); ?></option>
					<option value="disable" <?php !empty( $value['top-header-layout'] ) ? selected( $value['top-header-layout'], 'disable' ) : false; ?>><?php esc_html_e('Disable Top Header', 'catmandu'); ?></option>
				</select>
				<p class="description"><?php _e( 'Overrides default top header from customizer for this specific page.', 'catmandu' ); ?></p>
			</td>
		</tr>
		<tr>
			<th scope="row"><label for="transparent_header"><?php _e( 'Transparent Header Enable ?', 'catmandu' ); ?></label></th>
			<td>
				<select name="enable_transparent_header" class="enable-disable-transparent-header">
					<option value="global" <?php !empty( $value['transparent-header'] ) ? selected( $value['transparent-header'], 'global' ) : false; ?>><?php esc_html_e('Set to Global', 'catmandu'); ?></option>
					<option value="enable" <?php !empty( $value['transparent-header'] ) ? selected( $value['transparent-header'], 'enable' ) : false; ?>><?php esc_html_e('Enable Transparent Header', 'catmandu'); ?></option>
					<option value="disable" <?php !empty( $value['transparent-header'] ) ? selected( $value['transparent-header'], 'disable' ) : false; ?>><?php esc_html_e('Disable Transparent Header', 'catmandu'); ?></option>
				</select>
				<p class="description"><?php _e( 'Overrides default transparent header from customizer for this specific page.', 'catmandu' ); ?></p>
			</td>
		</tr>
	</tbody>
</table>