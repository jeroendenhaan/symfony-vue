// Fetch list of all characters from API backend
export async function getAllCharacters() {

    const response = await fetch('http://127.0.0.1:8080/api/character/');
    return await response.json();

}