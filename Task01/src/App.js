import "./App.css";
import { useState } from "react";
import { Button, Table, Group } from "@mantine/core";

const API_URL = `http://universities.hipolabs.com/search?country=Australia`;

function App() {
	const [data, setData] = useState([]);
	const [loading, setLoading] = useState(false);
	const [error, setError] = useState(false);

	const fetchData = () => {
		setData([]);
		setLoading(true);
		setError(false);
		fetch(API_URL)
			.then((response) => response.json())
			.then((actualData) => {
				setData(actualData);
			})
			.catch((err) => {
				setError(true);
				console.log(err.message);
			})
			.finally(() => {
				setLoading(false);
			});
	};

	const deleteData = () => {
		setData(data.slice(0, -1));
	};

	const addData = () => {
		setData([...data, data[0]]);
	};

	return (
		<div className="App">
			<Group mt="xl" className="buttons">
				<Button onClick={fetchData} data-testid="loadBt">
					Load
				</Button>
				<Button color="red" onClick={deleteData} data-testid="deleteBt">
					Delete
				</Button>
				<Button color="green" onClick={addData} data-testid="addBt">
					Add
				</Button>
			</Group>
			{loading && <h1>Loading...</h1>}
			{error && <h1>Something bad happend...</h1>}
			{data.length !== 0 && (
				<Table>
					<thead>
						<tr>
							<th>Alpha Two Code</th>
							<th>Country</th>
							<th>Domains</th>
							<th>Name</th>
							<th>Web Pages</th>
							<th>State Province</th>
						</tr>
					</thead>
					<tbody>
						{data.map((item, index) => (
							<tr key={index}>
								<td>{item.alpha_two_code}</td>
								<td>{item.country}</td>
								<td>{item.domains}</td>
								<td>{item.name}</td>
								<td>{item.web_pages}</td>
								<td>{item["state-province"]}</td>
							</tr>
						))}
					</tbody>
				</Table>
			)}
		</div>
	);
}

export default App;
