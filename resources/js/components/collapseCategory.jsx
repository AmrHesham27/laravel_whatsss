import React, { useState } from "react";
import { MenuItem, CardProduct } from "./index";
import { FontAwesomeIcon } from "@fortawesome/react-fontawesome";
import { faChevronDown } from "@fortawesome/free-solid-svg-icons";
import Collapse from "react-bootstrap/Collapse";

function CollapseCategory({ category }) {
    const displayCards = localStorage.getItem("displayCards");
    const [open, setOpen] = useState(true);

    return (
        <div className="collapse-item" id={`category_${category["id"]}`}>
            <button
                className="collapse-button"
                type="button"
                data-toggle="collapse"
                onClick={() => setOpen(!open)}
                aria-controls={`category_${category["id"]}`}
                aria-expanded={open}
            >
                <div className="w-100 d-flex justify-content-between align-content-center">
                    <span className="d-flex flex-column justify-content-center">
                        <FontAwesomeIcon icon={faChevronDown} size={"1x"} />
                    </span>
                    <span>{category["name"]}</span>
                </div>
            </button>

            <Collapse in={open}>
                <div id={`category_${category["id"]}`}>
                    {displayCards == "1" ? (
                        <div className="d-flex" style={{ flexWrap: "wrap" }}>
                            {category["products"].map((product, index) => (
                                <CardProduct key={index} product={product} />
                            ))}
                        </div>
                    ) : (
                        <div
                            className="card card-body"
                            style={{ border: "none" }}
                        >
                            {category["products"].map((product, index) => (
                                <MenuItem key={index} product={product} />
                            ))}
                        </div>
                    )}
                </div>
            </Collapse>
        </div>
    );
}

export default CollapseCategory;
