// withHooks

import { LibLazy } from 'esoftplay/cache/lib/lazy/import';
import { LibLoading } from 'esoftplay/cache/lib/loading/import';
import { LibNavigation } from 'esoftplay/cache/lib/navigation/import';
import { LibStyle } from 'esoftplay/cache/lib/style/import';
import useSafeState from 'esoftplay/state';
import { Camera } from 'expo-camera';
import React, { memo, useEffect, useRef } from 'react';
import { Button, Pressable, Text, View } from 'react-native';

export interface TeacherScanArgs {}
export interface TeacherScanProps {}

function m(props: TeacherScanProps): any {
 let isScanned = useRef<boolean>(false);
  const [hasPermission, setHasPermission] = useSafeState();
  let [result, setResult] = useSafeState<any>(null);

  useEffect(() => {
    (async () => {
      let { status } = await Camera.getCameraPermissionsAsync();
      if (status !== 'granted') {
        status = (await Camera.requestCameraPermissionsAsync()).status;
      }
      setHasPermission(status === 'granted');
    })();
  }, []);

  if (hasPermission === null) {
    return <View> <Text>hasPermission is null</Text></View>;
  }

  function onBarCodeScanned({ data }: any): void {
    setResult(data);
    switch (data) {
      case 'kelas 8A':
        LibNavigation.navigate('teacher/attandence', { data: data });
        break;
      case 'kelas 8B':
        LibNavigation.navigate('teacher/attandence', { data: data });
        break;
      case 'kelas 8C':
        LibNavigation.navigate('teacher/attandence', { data: data });
        break;
      case 'kelas 8D':
        LibNavigation.navigate('teacher/attandence', { data: data });
        break;
      case 'kelas 8E':
        LibNavigation.navigate('teacher/attandence', { data: data });
        break;
      default:
        break;
    }
    // if (data === 'kelas 8A') {
    //   LibNavigation.navigate('teacher/attandence', { data: data });
    // }
    // else if (data === 'kelas 8B') {
    
    // }
  }

  const cekscan: string = String(hasPermission) + " " + String(isScanned);

  // Fungsi untuk memulai pemindaian ulang
  const startScanningAgain = () => {
    isScanned.current = false; // Reset status pemindaian
    
    setResult(null); // Reset hasil pemindaian
  };

  return (
    <View style={{ flex: 1 }}>
      {hasPermission === true ?
        <View style={{ flex: 1, backgroundColor: "#000000" }} >
          <LibLazy>
            <Camera
              onBarCodeScanned={
                isScanned ? onBarCodeScanned : onBarCodeScanned
              }
              ratio={'16:9'}
              style={{ height: LibStyle.height, width: LibStyle.width }}>
            
              <View style={{ flex: 1, backgroundColor: 'transparent', justifyContent: 'center', alignItems: 'center', borderRadius: 15 }}>
                <Text style={{ color: '#ffffff', fontSize: 20, fontWeight: 'bold', marginBottom: 20 }}>Scan QR Code {result} {cekscan}</Text>
                <View style={{ width: LibStyle.width * 0.8, height: LibStyle.width * 0.8, borderWidth: 1, borderColor: '#ffffff', borderRadius: 15 }} />
              </View>
              {/* Tombol "Scan Ulang" */}
              <View style={{ marginBottom:130 }}>
                <Pressable onPress={startScanningAgain} style={{width:LibStyle.width * 0.8,height:40,backgroundColor:'green',alignSelf:'center',alignItems:'center',justifyContent:'center',borderRadius:12}} ><Text style={{color:'white',fontSize:15}}>Scan Lagi</Text></Pressable>
              </View>
            </Camera>
          </LibLazy>
        </View>
        :
        <View style={{ flex: 1, backgroundColor: "#000000" }} >
          <Text>Camera Permission Not Granted</Text>
          <LibLoading />
        </View>
      }
      
    </View>
  );
}

export default memo(m);