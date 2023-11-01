function createInputSearch() {
    const divParent = document.createElement("div");
    divParent.classList.add(
        "w-[200px]",
        "sm:w-auto",
        "relative",
        "mr-auto",
        "mt-3",
        "sm:mt-0"
    );

    const icon = document.createElement("i");
    icon.classList.add(
        "w-4",
        "h-4",
        "absolute",
        "my-auto",
        "inset-y-0",
        "ml-3",
        "left-0",
        "z-10",
        "text-slate-500",
        "fa-solid",
        "fa-magnifying-glass"
    );

    const input = document.createElement("input");
    input.classList.add("form-control", "w-full", "sm:w-64", "box", "py-10");
    input.setAttribute("type", "text");
    input.setAttribute("placeholder", "Cari lokasi");

    divParent.appendChild(icon);
    divParent.appendChild(input);

    return divParent;
}

/** Search Input */
const inputSearch = document.createElement("div");
inputSearch.classList.add("absolute");
inputSearch.appendChild(createInputSearch());

console.log(inputSearch);
