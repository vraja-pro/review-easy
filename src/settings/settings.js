/**
 * WordPress dependencies
 */
import { __ } from '@wordpress/i18n';
import { PanelBody } from '@wordpress/components';
import { render, useState, useCallback } from '@wordpress/element';
/**
 * Internal dependencies
 */
import useReviewEasyData from './components/data';
import ReviewEasyPerDayChart from './components/ReviewEasyPerDayChart';
import ReviewEasyPerMonthChart from './components/ReviewEasyPerMonthChart';
import RequestList from './components/RequestList';

const Settings = () => {
	const [timeSpanFilter, setTimeSpanFilter] = useState('Day');
	const [active, setActive] = useState('filter-one');

	const handleFilter = useCallback((event) => {
		setTimeSpanFilter(event.target.value);
		setActive(event.target.id);
	}, []);

	const ecoModeData = useReviewEasyData();
	// Get data.
	// console.log(ecoModeData);
	//ecoModeData?.file_mods?.prevented_requests

	return (
		<>
			<PanelBody initialOpen={true} title={__('ReviewEasy usage')}>
				<div className="review-easy__filter">
					<span>Filter:</span>
					<input
						id={'filter-one'}
						className={'filter-one' === active ? 'active' : ''}
						type="button"
						value="Day"
						onClick={(event) => handleFilter(event)}
					/>
					<input
						id={'filter-two'}
						className={'filter-two' === active ? 'active' : ''}
						type="button"
						value="Month"
						onClick={(event) => handleFilter(event)}
					/>
				</div>
				<div className="review-easy__chart-wrapper">
					<div className="review-easy__chart-panel">
						{timeSpanFilter === 'Day' ? (
							<ReviewEasyPerDayChart />
						) : (
							<ReviewEasyPerMonthChart />
						)}
					</div>
					<div className="review-easy__chart-text">
						<h2>ReviewEasy usage</h2>
						<p>
							With the ever-increasing impact of digital
							technology on our planet, it’s more important than
							ever to take steps to reduce our environmental
							impact.
						</p>
					</div>
				</div>
			</PanelBody>
			<PanelBody initialOpen={false} title={__('Request List')}>
				<RequestList requests={ecoModeData.requests} />
			</PanelBody>
		</>
	);
};

const App = () => {
	return <Settings />;
};

export default App;

document.addEventListener('DOMContentLoaded', () => {
	const htmlOutput = document.getElementById('review-easy-settings');

	if (htmlOutput) {
		render(<App />, htmlOutput);
	}
});
