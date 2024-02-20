// product画像 indexedDBリセット
$(function () {
    const dbName = "image_database";
    const objectStores = ["statuses", "images"];

    const request = indexedDB.open(dbName);

    request.onsuccess = function (event) {
        const db = event.target.result;

        objectStores.forEach(function (storeName) {
            const transaction = db.transaction([storeName], "readwrite");
            const objectStore = transaction.objectStore(storeName);
            objectStore.clear();
        });
    };
});
