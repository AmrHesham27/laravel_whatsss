import React, { useEffect, useState } from "react";
import CollapseCategory from "./collapseCategory";
import MenuItem from "./menuItem";
import CardProduct from "./CardProduct";

function menu({ products, categories, currency, displayCards, color_1, color_2 }) {
    const [searchItems, setSearchItems] = useState([]);
    const [showSearch, setShowSearch] = useState(false);
    const [userInput, setUserInput] = useState("");

    const search = () => {
        setSearchItems([]);
        setShowSearch(true);
        products.filter((product) => {
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
                          currency={currency}
                          color_1={color_1}
                      />
                  ))
                : undefined}
            {searchItems.length && showSearch && !displayCards
                ? searchItems.map((product, index) => (
                      <MenuItem
                          key={index}
                          product={product}
                          currency={currency}
                          color_2={color_2}
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
                          currency={currency}
                          displayCards={displayCards}
                          color_1={color_1}
                          color_2={color_2}
                      />
                  ))
                : undefined}
        </div>
    );
}

export default menu;