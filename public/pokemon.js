// Import React and any other necessary dependencies
import React, { useEffect, useState } from 'react';
import axios from 'axios';

function DataFetchingComponent() {
  const [data, setData] = useState([]);

  useEffect(() => {
    // Fetch data from the JSON file using Axios
    axios.get('pokedex.json')
      .then((response) => {
        setData(response.data.items);
      })
      .catch((error) => {
        console.error('Error fetching data:', error);
      });
  }, []);

  return (
    <div>
      <h1>Data from JSON</h1>
      <ul>
        {data.map((item) => (
          <li key={item.id}>
            <strong>Name:</strong> {item.name}, <strong>Description:</strong> {item.description}
          </li>
        ))}
      </ul>
    </div>
  );
}

export default DataFetchingComponent;
