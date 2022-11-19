import { screen, render } from "@testing-library/react";
import App from "./App";

test("Action Button Works", () => {
	render(<App />);

	const loadBt = screen.queryByTestId("loadBt");
	const deleteBt = screen.queryByTestId("deleteBt");
	const addBt = screen.queryByTestId("addBt");

	expect(loadBt).toBeInTheDocument();
	expect(deleteBt).toBeInTheDocument();
	expect(addBt).toBeInTheDocument();
});
