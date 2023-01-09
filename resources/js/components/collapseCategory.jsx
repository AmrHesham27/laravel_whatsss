import React from "react";
import MenuItem from "./menuItem";
import Row from "react-bootstrap/Row";
import CardProduct from "./CardProduct";

function collapseCategory({ category, currency, displayCards, color }) {
    return (
        <div className="collapse-item" id={`category_${category["id"]}`}>
            <button
                className="collapse-button"
                type="button"
                data-toggle="collapse"
                data-target={`#menu-items_${category["id"]}`}
                aria-expanded="false"
                aria-controls="collapseExample"
            >
                <div className="w-100 d-flex justify-content-between align-content-center">
                    <span className="d-flex flex-column justify-content-center">
                        <i
                            className="fa fa-chevron-down"
                            aria-hidden="true"
                        ></i>
                    </span>
                    <span>{category["name"]}</span>
                </div>
            </button>

            <div className="collapse show" id={`menu-items_${category["id"]}`}>
                {displayCards ? (
                    <div className="d-flex" style={{ flexWrap: "wrap" }}>
                        {category["products"].map((product, index) => (
                            <CardProduct
                                key={index}
                                product={product}
                                currency={currency}
                                color={color}
                            />
                        ))}
                    </div>
                ) : (
                    <div className="card card-body" style={{ border: "none" }}>
                        {category["products"].map((product, index) => (
                            <MenuItem
                                key={index}
                                product={product}
                                currency={currency}
                            />
                        ))}
                    </div>
                )}
            </div>
        </div>
    );
}

export default collapseCategory;
