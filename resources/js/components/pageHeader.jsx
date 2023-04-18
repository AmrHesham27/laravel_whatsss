import React from "react";
import { FontAwesomeIcon } from "@fortawesome/react-fontawesome";
import { faBarsStaggered } from "@fortawesome/free-solid-svg-icons";
import { faShoppingCart } from "@fortawesome/free-solid-svg-icons";
import Dropdown from 'react-bootstrap/Dropdown';
import { modalsActions } from "../redux/modals";
import { useDispatch } from "react-redux";

function PageHeader({ store }) {

    const color1 = localStorage.getItem('color_1');

    const scroll = (id) => {
        document.getElementById(id).scrollIntoView({ behavior: 'smooth' });
    }

    const dispatch = useDispatch();

    return (
        <>
            <div className="my-header">
                <div className="my-header-container">
                    <Dropdown>
                        <Dropdown.Toggle style={{ padding: 0 }}>
                            <FontAwesomeIcon
                                icon={faBarsStaggered}
                                style={{
                                    color: `${color1}`,
                                    margin: "auto 0",
                                    cursor: 'pointer',
                                }}
                            />
                        </Dropdown.Toggle>

                        <Dropdown.Menu>
                            {
                                store.categories.map((category, index) =>
                                    <div
                                        key={index}
                                        onClick={() => scroll(`category_${category.id}`)}
                                        className="header-category"
                                    >
                                        {category.name}
                                    </div>
                                )
                            }
                        </Dropdown.Menu>
                    </Dropdown>
                    <img
                        src={`/images/${store["logo"]}`}
                        alt="store logo"
                    />
                    <FontAwesomeIcon
                        icon={faShoppingCart}
                        style={{
                            color: `${color1}`,
                            margin: "auto 0",
                            cursor: 'pointer',
                        }}
                        onClick={() => dispatch(modalsActions.toggleCartModal())}
                    />
                </div>
            </div>
            <div className="my-header-image">
                <img src={`/images/${store["cover"]}`} alt="cover" />
            </div>
        </>
    );
}

export default PageHeader;
