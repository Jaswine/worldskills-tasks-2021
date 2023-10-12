
// just scripts in another file
const AppScripts = () => {
    // Images Sorting
    function sortImages (massive) {
      return massive.sort(() => Math.random() - 0.5)
    }
    // return 
    return {sortImages}
}

export default AppScripts