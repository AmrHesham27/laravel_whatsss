import React, { useEffect, useState } from "react";
import CollapseCategory from "./collapseCategory";
import MenuItem from "./menuItem";
import CardProduct from "./CardProduct";

function menu({ products, categories, displayCards }) {

    const [searchItems, setSearchItems] = useState([]);
    const [showSearch, setShowSearch] = useState(false);
    const [userInput, setUserInput] = useState("");

    let allProducts = []
    products.forEach((i) => {allProducts.push(...i)})

    const search = () => {
        setSearchItems([]);
        setShowSearch(true);
        allProducts.forEach((product) => {
            if (product["name"].indexOf(userInput) > -1) {
                setSearchItems((state) => [...state, product]);
            } else setSearchItems([]);
        });
    };

    useEffect(() => {
        if (userInput === "") {
            setSearchItems([]);
            setShowSearch(false);
        } else search();
    }, [userInput]);

    const color_1 = localStorage.getItem('color_1');

    return (
        <div className="menu">
            <div className="search-bar">
                <input
                    onChange={(e) => setUserInput(e.target.value)}
                    type="text"
                    placeholder="البحث عن أصناف"
                ></input>
                <div className="d-flex flex-coumn jsutify-content-center">
                    <i
                        style={{
                            color_1: "rgb(190, 190, 190)",
                            marginLeft: "5px",
                        }}
                        className="fa fa-search"
                        aria-hidden="true"
                    ></i>
                </div>
            </div>
            {searchItems.length && showSearch && displayCards
                ? searchItems.map((product, index) => (
                      <CardProduct
                          key={index}
                          product={product}
                      />
                  ))
                : undefined}
            {searchItems.length && showSearch && !displayCards
                ? searchItems.map((product, index) => (
                      <MenuItem
                          key={index}
                          product={product}
                      />
                  ))
                : undefined}
            {!searchItems.length && showSearch ? (
                <p>لا يوجد عناصر تطابق بحثك</p>
            ) : undefined}
            {!showSearch
                ? categories.map((category, index) => (
                      <CollapseCategory
                          key={index}
                          category={category}
                          displayCards={displayCards}
                      />
                  ))
                : undefined}
        </div>
    );
}

export default menu;