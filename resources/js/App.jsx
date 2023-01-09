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

export default function App({store}) {
    console.log(store)
    return (
        <Provider store={reduxStore}>
            <PageHeader image={store["logo"]} />
            <div className="page-container">
                <PageBody store={store} />
                <SendToWhatsapp whatsapp={store['whatsapp']} color={store['color_1']} />
                <ModalCart delivery_fees={store["delivery_fees"]} color={store['color_1']} />
            </div>
            <ResponsiveCart delivery_fees={store["delivery_fees"]} color={store['color_1']} />
        </Provider>
    );
}

if (document.getElementById("root")) {
    var data = document.getElementById("root").getAttribute("data");
    createRoot(document.getElementById("root"))
        .render(<App store={JSON.parse(data)} />);
}
