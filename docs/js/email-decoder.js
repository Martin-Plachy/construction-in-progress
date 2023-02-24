const encodedEmailAddress = "cmV2aXplQHRpbWlkdXNyZXZpemUuY3o=";
const emailAddressCollection = document.getElementsByClassName("email-address");

for (let i = 0; i < emailAddressCollection.length; i++){
emailAddressCollection.item(i).setAttribute("href", "mailto:".concat(atob(encodedEmailAddress)));
}
