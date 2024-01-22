/**
 * External dependencies
 */
/**
 * WordPress dependencies
 */
import { useMemo } from '@wordpress/element';

function useReviewEasyData() {
	const ecoModeData = useMemo(() => window.ReviewEasySettings || {}, []);

	return ecoModeData;
}

export default useReviewEasyData;
