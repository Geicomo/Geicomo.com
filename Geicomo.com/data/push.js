const fs = require('fs');

// Read the content of the JSON file synchronously
let rawData = fs.readFileSync('../data/data.json');
let users = JSON.parse(rawData);

// New values to update for all users
let updatedValues = {
    "email": null
};

// Updating all users in the object with new values
Object.keys(users).forEach(username => {
    let user = users[username];
    Object.keys(updatedValues).forEach(key => {
        user[key] = updatedValues[key];
    });
});

// Function to format users object
const formatUsersObject = (usersObj) => {
    return '{\n' + Object.keys(usersObj).map(username => {
        return `    "${username}": ${JSON.stringify(usersObj[username], null, 4)}`;
    }).join(',\n') + '\n}';
};

// Displaying the updated user object in the desired format
console.log(formatUsersObject(users));

// Optionally, write the updated data back to the file
fs.writeFileSync('../data/data.json', JSON.stringify(users, null, 4));

