import { useEffect } from "react";
import api from "./api/axios";

function App() {
  useEffect(() => {
    api.get("/health")
      .then((response) => console.log(response.data))
      .catch((error) => console.error(error));
  }, []);

  return <h1>WorkNest</h1>;
}

export default App;
