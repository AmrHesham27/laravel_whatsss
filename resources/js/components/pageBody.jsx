import React from "react";
import Cart from "./cart";
import Info from "./info";
import Menu from "./menu";
import CategoriesList from "./categories";

function pageBody({ store }) {
    const color_1 = localStorage.getItem("color_1");

    return (
        <div className="d-flex flex-column mb-5">
            <nav className="navbar my-nav d-flex justify-content-end">
                <div className="nav nav-tabs" id="nav-tab" role="tablist">
                    <a
                        className="nav-item nav-link active"
                        id="nav-home-tab"
                        data-toggle="tab"
                        href="#nav-home"
                        role="tab"
                        aria-controls="nav-home"
                        aria-selected="true"
                    >
                        قائمة الطعام
                        <i
                            style={{
                                color: color_1,
                                marginLeft: "5px",
                            }}
                            className="fa fa-utensils menu-icon"
                            aria-hidden="true"
                        ></i>
                    </a>

                    <a
                        className="nav-item nav-link f-18"
                        id="nav-profile-tab"
                        data-toggle="tab"
                        href="#nav-profile"
                        role="tab"
                        aria-controls="nav-profile"
                        aria-selected="false"
                    >
                        معلومات المطعم
                        <i
                            style={{
                                color: color_1,
                                marginLeft: "5px",
                            }}
                            className="fa fa-info-circle menu-icon"
                            aria-hidden="true"
                        ></i>
                    </a>
                </div>
            </nav>

            <div className="d-flex">
                <Cart />
                <div className="tab-content" id="nav-tabContent">
                    <div
                        className="tab-pane fade"
                        id="nav-profile"
                        role="tabpanel"
                        aria-labelledby="nav-profile-tab"
                    >
                        <div className="body-container">
                            <Info />
                        </div>
                    </div>
                    <div
                        className="tab-pane fade show active"
                        id="nav-home"
                        role="tabpanel"
                        aria-labelledby="nav-home-tab"
                    >
                        <div className="body-container">
                            <Menu
                                products={store["products"]}
                                categories={store["categories"]}
                            />
                            <CategoriesList categories={store["categories"]} />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    );
}

export default pageBody;
