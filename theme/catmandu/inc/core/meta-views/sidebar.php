<table class="form-table catmandu-page-settings-box" role="presentation">
	<tbody>
		<tr>
			<th scope="row"><label for="page_sidebar"><?php _e( 'Sidebar Positon ?', 'catmandu' ); ?></label></th>
			<td>
				<select name="page_sidebar" class="page_sidebar">
					<option value="default" <?php !empty( $value['page-sidebar'] ) ? selected( $value['page-sidebar'], 'default' ) : false; ?>><?php esc_html_e('Set to Global', 'catmandu'); ?></option>
					<option value="none" <?php !empty( $value['page-sidebar'] ) ? selected( $value['page-sidebar'], 'none' ) : false; ?>><?php esc_html_e('No sidebar', 'catmandu'); ?></option>
					<option value="right" <?php !empty( $value['page-sidebar'] ) ? selected( $value['page-sidebar'], 'right' ) : false; ?>><?php esc_html_e('Right', 'catmandu'); ?></option>
					<option value="left" <?php !empty( $value['page-sidebar'] ) ? selected( $value['page-sidebar'], 'left' ) : false; ?>><?php esc_html_e('Left', 'catmandu'); ?></option>
				</select>
				<p class="description"><?php _e( 'Overrides default sidebar position from customizer for this specific page. Targets buttons and background color elements on this specific page.', 'catmandu' ); ?></p>
			</td>
		</tr>
	</tbody>
</table>