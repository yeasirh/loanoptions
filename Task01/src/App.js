import "./App.css";
import { useState } from "react";
import { Button, Table } from "@mantine/core";

function App() {
	const [data, setData] = useState([]);

	const fetchData = () => {
		fetch(`http://universities.hipolabs.com/search?country=Australia`)
			.then((response) => response.json())
			.then((actualData) => {
				setData(actualData);
			})
			.catch((err) => {
				console.log(err.message);
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
			<Button onClick={fetchData}>Load</Button>
			<Button color="red" onClick={deleteData}>
				Delete
			</Button>
			<Button color="green" onClick={addData}>
				Add
			</Button>

			<Table>
				<thead>
					<tr>
						<th>alpha_two_code</th>
						<th>country</th>
						<th>domains</th>
						<th>name</th>
						<th>web_pages</th>
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
						</tr>
					))}
				</tbody>
			</Table>
		</div>
	);
}

export default App;
