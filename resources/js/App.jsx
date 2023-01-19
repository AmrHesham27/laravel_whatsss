import React from "react";
import { createRoot } from "react-dom/client";

// components
import PageHeader from "./components/pageHeader";
import PageBody from "./components/pageBody";
import SendToWhatsapp from "./components/sendToWhatsapp";
import ResponsiveCart from "./components/responsiveCart";
import ModalCart from "./components/modalCart";

// redux
import { Provider } from "react-redux";
import reduxStore from "./redux/store";

export default function App({ store }) {
    console.log(store);
    return (
        <Provider store={reduxStore}>
            <PageHeader image={store["logo"]} />
            <div className="page-container">
                <PageBody store={store} />

                <ModalCart
                    delivery_fees={store["delivery_fees"]}
                    color_1={store["color_1"]}
                    color_2={store["color_2"]}
                />
            </div>
            <ResponsiveCart
                delivery_fees={store["delivery_fees"]}
                color_1={store["color_1"]}
            />
            <SendToWhatsapp
                whatsapp={store["whatsapp"]}
                color_1={store["color_1"]}
                color_2={store["color_2"]}
                dinIn={store["dinIn"]}
                pickUp={store["pickUp"]}
                deliveryPlaces={store["deliveryPlaces"]}
                places={store["places"]}
                currency={store["currency"]}
            />
        </Provider>
    );
}

if (document.getElementById("root")) {
    var data = document.getElementById("root").getAttribute("data");
    createRoot(document.getElementById("root")).render(
        <App store={JSON.parse(data)} />
    );
}
