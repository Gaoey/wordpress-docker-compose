<table class="form-table catmandu-page-settings-box" role="presentation">
	<tbody>
		<tr>
			<th scope="row"><label for="footer_widget_section"><?php _e( 'Display Footer Widget Area ?', 'catmandu' ); ?></label></th>
			<td>
				<select name="enable_footer_widget_section">
					<option value="global" <?php !empty( $value['footer-widget-display'] ) ? selected( $value['footer-widget-display'], 'global' ) : false; ?>><?php esc_html_e('Set to Global', 'catmandu'); ?></option>
					<option value="enable" <?php !empty( $value['footer-widget-display'] ) ? selected( $value['footer-widget-display'], 'enable' ) : false; ?>><?php esc_html_e('Enable Footer Widget Area', 'catmandu'); ?></option>
					<option value="disable" <?php !empty( $value['footer-widget-display'] ) ? selected( $value['footer-widget-display'], 'disable' ) : false; ?>><?php esc_html_e('Disable Footer Widget Area', 'catmandu'); ?></option>
				</select>
				<p class="description"><?php _e( 'Overrides default footer widget area from customizer for this specific page.', 'catmandu' ); ?></p>
			</td>
		</tr>
		<tr>
			<th scope="row"><label for="footer_copyright_area"><?php _e( 'Display Copyright Area ?', 'catmandu' ); ?></label></th>
			<td>
				<select name="enable_footer_copyright_area">
					<option value="global" <?php !empty( $value['footer-copyright-display'] ) ? selected( $value['footer-copyright-display'], 'global' ) : false; ?>><?php esc_html_e('Set to Global', 'catmandu'); ?></option>
					<option value="enable" <?php !empty( $value['footer-copyright-display'] ) ? selected( $value['footer-copyright-display'], 'enable' ) : false; ?>><?php esc_html_e('Enable Copyright Area', 'catmandu'); ?></option>
					<option value="disable" <?php !empty( $value['footer-copyright-display'] ) ? selected( $value['footer-copyright-display'], 'disable' ) : false; ?>><?php esc_html_e('Disable Copyright Area', 'catmandu'); ?></option>
				</select>
				<p class="description"><?php _e( 'Overrides default footer copyright area from customizer for this specific page.', 'catmandu' ); ?></p>
			</td>
		</tr>
	</tbody>
</table>