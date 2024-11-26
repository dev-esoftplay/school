// withHooks
import { memo } from 'react';
import { LibCurl } from 'esoftplay/cache/lib/curl/import';
import { LibLazy } from 'esoftplay/cache/lib/lazy/import';
import { LibLoading } from 'esoftplay/cache/lib/loading/import';
import { LibNavigation } from 'esoftplay/cache/lib/navigation/import';
import { LibStyle } from 'esoftplay/cache/lib/style/import';
import useSafeState from 'esoftplay/state';
import React, { useEffect, useRef } from 'react';
import { Pressable, Text, View, Button} from 'react-native';
import { LibDialog } from 'esoftplay/cache/lib/dialog/import';
import esp from 'esoftplay/esp';
import { CameraView, useCameraPermissions } from 'expo-camera';

export interface TeacherScanArgs {}
export interface TeacherScanProps {}

function m(): any { 
  let isScanned = useRef<boolean>(false);
  const [permission, requestPermission] = useCameraPermissions();
  const [isLoading, setIsLoading] = useSafeState(true); // Untuk mengontrol loading
  const [result, setResult] = useSafeState<any>(null);
  const [ApiResponse, setResApi] = useSafeState<any>();

  useEffect(() => {
    // Ambil data jadwal dari API
    new LibCurl(
      'teacher_schedule',
      null,
      (result) => {
        console.log('result :', result);
        setResApi(result);
        setIsLoading(false); // Hentikan loading setelah data berhasil diambil
      },
      (error) => {
        console.log('error :', error);
        setIsLoading(false); // Hentikan loading meskipun terjadi error
      }
    );
  }, []);

  if (isLoading) {
    return <LibLoading />;
  }

  if (!permission) {
    return <LibLoading />;
  }

  if (!permission.granted) {
    return (
      <View style={{ flex: 1, justifyContent: 'center', alignItems: 'center', backgroundColor: '#000', }}>
        <Text style={{ color: '#fff',fontSize: 16,textAlign: 'center',marginBottom: 10, }}>Kami perlu izin akses kamera!</Text>
        <Button onPress={requestPermission} title="Grant Permission" />
      </View>
    );
  }

  const schedule_id = ApiResponse?.schedule[0]?.data[0].schedule_id;
  const class_id = ApiResponse?.schedule[0]?.data[0].class.id;
  const course_id = ApiResponse?.schedule[0]?.data[0].course.id;

  function onBarcodeScanned({ data }: any): void {
    if (!isScanned.current) {
      isScanned.current = true;
      setResult(data);

      if (data === `http://api.test.school.esoftplay.com/student_class?class_id=${class_id}`) {
        console.log('data :', data);
        LibNavigation.navigate('teacher/scanattandence', {
          url: data,
          schedule_id: schedule_id,
          class_id: class_id,
          course_id: course_id,
        });
      } else {
        esp.log(esp.logColor.red, 'QR Code tidak valid', data);
        LibDialog.warning('QR Code tidak valid', 'Anda tidak mengajar kelas ini pada jam ini');
        isScanned.current = false; // Reset setelah validasi gagal
      }
    }
  }

  const startScanningAgain = () => {
    isScanned.current = false; // Reset status pemindaian
    setResult(null); // Reset hasil pemindaian
    console.log('startScanningAgain');
  };

  return (
    <View style={{ flex: 1 }}>
      <View style={{ flex: 1, backgroundColor: '#000000' }}>
        <LibLazy>
          <CameraView
            onBarcodeScanned={onBarcodeScanned} // Gunakan onBarcodeScanned
            style={{ height: LibStyle.height, width: LibStyle.width }}
          >
            <View
              style={{
                flex: 1,
                backgroundColor: 'transparent',
                justifyContent: 'center',
                alignItems: 'center',
                borderRadius: 15,
              }}
            >
              <Text style={{ color: '#ffffff', fontSize: 20, fontWeight: 'bold', marginBottom: 20 }}>
                Scan QR Code
              </Text>
              <View
                style={{
                  width: LibStyle.width * 0.8,
                  height: LibStyle.width * 0.8,
                  borderWidth: 1,
                  borderColor: '#ffffff',
                  borderRadius: 15,
                }}
              />
            </View>
            {/* Tombol "Scan Ulang" */}
            <View style={{ marginBottom: 171 }}>
              
              <Pressable
                onPress={startScanningAgain}
                style={{
                  width: LibStyle.width * 0.8,
                  height: 30,
                  backgroundColor: 'white',
                  alignSelf: 'center',
                  alignItems: 'center',
                  justifyContent: 'center',
                  borderRadius: 10,
                }}
              >
                <Text style={{ color: 'black', fontSize: 15, fontWeight : 600}}>Scan ulang</Text>
              </Pressable>
            </View>
          </CameraView>
        </LibLazy>
      </View>
    </View>
  );
}

export default memo(m);
