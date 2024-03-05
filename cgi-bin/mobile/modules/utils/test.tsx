// withHooks

import { useState, useEffect, useRef } from 'react';
import { Text, View, Button, Platform } from 'react-native';

import * as Notifications from 'expo-notifications';
import { LibList } from 'esoftplay/cache/lib/list/import';
import { LibNotification } from 'esoftplay/cache/lib/notification/import';
import { LibStyle } from 'esoftplay/cache/lib/style/import';
import moment from 'esoftplay/moment';
import { LibInput_rectangle2 } from 'esoftplay/cache/lib/input_rectangle2/import';

export interface TestArgs {

}
export interface TestProps {

}

Notifications.setNotificationHandler({
  handleNotification: async () => ({
    shouldShowAlert: true,
    shouldPlaySound: false,
    shouldSetBadge: false,
  }),
});

export default function m(props: TestProps): any {
  const [jamInput, setJamInput] = useState<string>(''); // State untuk menyimpan waktu yang diinput
  
    const [notification, setNotification] = useState<Notifications.Notification | null>(null);
    const notificationListener = useRef<undefined | Notifications.Subscription>();
    const responseListener = useRef<undefined | Notifications.Subscription>();

    useEffect(() => {
      notificationListener.current = Notifications.addNotificationReceivedListener(notification => {
        setNotification(notification);
      });

      responseListener.current = Notifications.addNotificationResponseReceivedListener(response => {
        console.log(response);
      });
    
      return () => {
        if (notificationListener.current) {
          Notifications.removeNotificationSubscription(notificationListener.current);
        }
        if (responseListener.current) {
          Notifications.removeNotificationSubscription(responseListener.current);
        }
      }
    }, []);

    const isBetweentime = (clock_start: string, clock_end: string) => {
      const currentTime = moment().format('HH:mm');
      // console.log("currentTime", currentTime)
      return currentTime >= clock_start && currentTime < clock_end;
    };
    
    async function schedulePushNotification() {
        const currentTime = moment(); // Waktu saat ini
        const inputTime = moment(jamInput ); // Waktu yang diinput dengan format jam

       
  


        if (currentTime.format('HH:mm:ss') > inputTime.format('HH:mm:ss') ){
          console.log('Waktu yang diinput masih belum lewat.');
            console.log('Waktu saat ini: ', currentTime.format('HH:mm:ss'));
            console.log('Waktu format yang diinput: ', inputTime.format('HH:mm:ss'));
            console.log('Waktu yang diinput: ', inputTime);
            await Notifications.scheduleNotificationAsync({
                content: {
                    title: "Waktu yang diinput telah lewat",
                    body: `Waktu ${inputTime.format('HH:mm')} telah lewat.`,
                    data: { data: 'goes here' },
                },
                trigger: null, // Notifikasi akan muncul langsung
            });
        } else {
            console.log('Waktu yang diinput masih belum lewat.');
            console.log('Waktu saat ini: ', currentTime.format('HH:mm:ss'));
            console.log('Waktu format yang diinput: ', inputTime.format('HH:mm:ss'));
            console.log('Waktu yang diinput: ', jamInput);
        }
    }
    
    return (
        <View style={{ flex: 1, backgroundColor: 'white', padding: 10, marginTop: LibStyle.STATUSBAR_HEIGHT }}>
            {/* Konten Notifikasi */}
            <View style={{ alignItems: 'center', justifyContent: 'center' }}>
                <Text>Title: {notification && notification.request.content.title} </Text>
                <Text>Body: {notification && notification.request.content.body}</Text>
                <Text>Data: {notification && JSON.stringify(notification.request.content.data)}</Text>
            </View>

            {/* Input Jam */}
            <Text style={{ fontSize: 24, fontWeight: 'bold', marginBottom: 30, marginLeft: 10 }}>Jam</Text>
            <LibInput_rectangle2
                placeholderTextColor='gray'
                inputStyle={{ fontSize: 16, color: 'black', marginRight: 15, marginLeft: 8 }}
                placeholder='(format: jammenitdetik, contoh: 125700)'
                onChangeText={(text: string) => setJamInput(text)} // Ambil input dari pengguna
            />

            {/* Tombol untuk menjadwalkan notifikasi */}
            <Button
                title="Tekan untuk menjadwalkan notifikasi"
                onPress={async () => {
                    await schedulePushNotification();
                }}
            />
        </View>
    );
}
