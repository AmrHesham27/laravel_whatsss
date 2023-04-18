import React, { useEffect, useState } from "react";
import { CollapseCategory, CardProduct, MenuItem } from "./index";
import { FontAwesomeIcon } from "@fortawesome/react-fontawesome";
import { faSearch } from "@fortawesome/free-solid-svg-icons";

function Menu({ products, categories }) {
    const [searchItems, setSearchItems] = useState([]);
    const [showSearch, setShowSearch] = useState(false);
    const [userInput, setUserInput] = useState("");

    const search = () => {
        setSearchItems([]);
        setShowSearch(true);
        products.forEach((product) => {
            if (product["name"].indexOf(userInput) > -1) {
                setSearchItems((state) => [...state, product]);
            }
        });
    };

    useEffect(() => {
        if (userInput === "") {
            setSearchItems([]);
            setShowSearch(false);
        } else search();
    }, [userInput]);

    const displayCards = localStorage.getItem("displayCards");

    return (
        <div className="menu">
            <div className="search-bar">
                <input
                    onChange={(e) => setUserInput(e.target.value)}
                    type="text"
                    placeholder="البحث عن أصناف"
                ></input>
                <div className="d-flex flex-coumn jsutify-content-center">
                    <FontAwesomeIcon
                        icon={faSearch}
                        size={"1x"}
                        style={{
                            color: "rgb(190, 190, 190)",
                            margin: "5px",
                        }}
                    />
                </div>
            </div>
            {searchItems.length && showSearch && displayCards == "1"
                ? <div className="products-cards-container">{searchItems.map((product, index) => (
                      <CardProduct key={index} product={product} />
                  ))}</div>
                : undefined}
            {searchItems.length && showSearch && displayCards != "1"
                ? searchItems.map((product, index) => (
                      <MenuItem key={index} product={product} />
                  ))
                : undefined}
            {!searchItems.length && showSearch ? (
                <p className="text-end">لا يوجد عناصر تطابق بحثك</p>
            ) : undefined}
            {!showSearch
                ? categories.map((category, index) => (
                      <CollapseCategory key={index} category={category} />
                  ))
                : undefined}
        </div>
    );
}

export default Menu;
